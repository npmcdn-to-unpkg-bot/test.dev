$('document').ready(function(){

    var headers= {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    var formData=function(form){
        return form.serializeArray();
    }
//--------------------------------GLOBAL FUNCTIONS-------------------------

    /**
     * reload page if response status success (response code 200)
     * @param delay - after which the page forced reload
     */
    var reload=function(delay){

        if(typeof delay!=='undefined'){
            setTimeout(function(){
                document.location.reload(true);
            },delay);
        }
        else {
            document.location.reload(true);
        }
    };

    /**
     *  render errors on the form to group-*(model,article, e.t.c)
     * @param errors - object with errors
     */
    var renderErrors=function(errors){

        if(typeof errors==="object"){
            $.each(errors,function(key,value){
                var group=$('.group-'+key);
                group.addClass('has-error');
                group.append('<span class="help-block"><small>'+value+'</small></span>');
            })
        }
    };
//-----------------------------------------------------------------------------------------

    var formCategoryStore=$('#formCategoryStore');
    var btnCategoryStore=$('#btnCategoryStore');

    $('#createCategory').modal({
        show:false
    }).on('show.bs.modal', function (event) {

    });

    btnCategoryStore.on('click',function(e){

        $.ajax({
            url:formCategoryStore.attr('action'),
            method:formCategoryStore.attr('method'),
            data:formCategoryStore.serializeArray(),
            dataType:'json'
        }).done(function(response){
            console.log(response);
        });

    });

    /**
     * Load data to DataTable from Database
     * @type {*|jQuery}
     */

    var table=$('#records-table').DataTable({
        ajax:{
            url:'/api/products',
            dataSrc:''
        },
        columns: [
            { "data": "id" },
            { "data":"photo"},
            { "data": "model" },
            { "data": "article" } ,
            { "data": "published"},
            { "data":  "new" },
            {
                "data": null, // can be null or undefined
                "defaultContent": "<div class='btn-group btn-group-sm'>" +
                "<a class='btn btn-info btn-edit' href='#' data-url='/dashboard/products/:id/edit' title='Редактировать запись'><i class='fa fa-edit'></i></a>" +
                "<a class='btn btn-danger btn-delete' href='#' data-url='/api/products/:id' title='Удалить запись'><i class='fa fa-trash-o'></i></a>" +
                "</div>"
            }
        ],
        columnDefs:[
            {
                "data":'photo',
                "targets":1,
                "render":function(data,type,row,meta){
              if(data)
                    return "<img src='/img/"+row.model+"/small/"+row.photo+"'>";
                    else
              return "not found";
                }
            },
            {
                "className":'text-center',
                "targets":4,
                "data":'published',
                "render":function(data,type,row,meta){
                    if(data)
                        return '<a class="btn-publish" href="/dashboard/products/'+row.id+'/publish"><i class="fa fa-toggle-on"></i></a>';
                    else
                        return '<a class="btn-publish" href="/dashboard/products/'+row.id+'/publish"><i class="fa fa-toggle-off"></i></a>';
                }
            },
            {
                "targets":7,
                "data":null,
                "render":function(row){
                    return "<a class='btn btn-primary' href='/dashboard/products/"+row.id+"/files'><i class='fa fa-upload'></i></a>"
                }
            }
        ]

    });

    /**
     * Create & Save new Product in Catalog
     */
    $('#storeProduct').on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:$(this).serializeArray(),
            dataType:'json'
        }).done(function(response){
            console.log(response);
            //reload(1000);
            location.href='/dashboard/products';
        }).error(function(response){

            renderErrors(response.responseJSON);

        });

    });

    /**
     * Delete product from uploads
     */

    $('#records-table tbody').on('click','a.btn-delete',function(e){
        e.stopPropagation();
        var self=$(this);
        var data = table.row( self.parents('tr') ).data();
        var url=self.data('url').replace(':id',data.id);

        bootbox.confirm("Удалить модель&nbsp;"+data.model+"&nbsp;?",function(result){

            if(result) {
                $.ajax({
                    url:url,
                    method:'DELETE',
                    headers:headers
                }).done(function(response){
                    table.row(self.parents('tr')).remove().draw();
                    bootbox.alert(response.message);
                }).fail(function(response){
                    bootbox.alert(JSON.stringify(response));
                });

            }else{
            }
        });
    });

    /**
     * Redirect to page for editing the product
     */

    $('#records-table tbody').on('click','a.btn-edit',function(e){
        e.stopPropagation();
        var self=$(this);
        var data = table.row( self.parents('tr') ).data();
        var url=self.data('url').replace(':id',data.id);

        window.location.href=url;
    });

    /**
     * Update the product in Catalog (DB)
     */

    $('#editProduct').on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();

        var self=$(this);


        $.ajax({
            url:self.attr('action'),
            method:$('input[name="_method"]').val(),
            // headers:headers,
            data:self.serializeArray()
        }).done(function(response){
            location.href='/dashboard/products';
            //console.log(response);
        }).fail(function(response){
            bootbox.alert(JSON.stringify(response));
        });

    });

    /**
     * Publish the product
     */
    $('#records-table tbody').on('click','a.btn-publish',function(e){

        e.preventDefault();
        e.stopPropagation();

        var self=$(this);
        var data = table.row(self.parents('tr')).data();
        var i=self.find('i');

        $.ajax({
            url:self.attr('href'),
            method:'POST',
            headers:headers
        }).done(function(response){
            if(response.published)
                i.removeClass('fa-toggle-off').addClass('fa-toggle-on');
            else
                i.removeClass('fa-toggle-on').addClass('fa-toggle-off');
        });

    });


    //------------------------------------------------------------------------------------------------------
    /*  $('#records-table tbody').on('click','tr',function(){

     if ( $(this).hasClass('selected') ) {
     $(this).removeClass('selected');
     }
     else {
     table.$('tr.selected').removeClass('selected');
     $(this).addClass('selected');
     }
     });*/

    /**
     * Init select input using "Select2" plugin
     */

    $('#select-category').select2({
        placeholder:'Выберите категорию...',
        allowClear:true
    });
    $('#select-material').select2({
        placeholder:"Выберите материал...",
        allowClear:true
    });
    $('#select-season').select2({
        placeholder:"Выберите сезон...",
        allowClear:true
    });
    $('#select-new').select2();

    /**
     * Init growth & size input using "IonRangeSlider"
     */
    $('#growth-range').ionRangeSlider({
        type:'double',
        min:152,
        max:188,
        step:2,
        grid:true,
        grid_snap:true,
        from:164,
        to:170

    });

    $('#size-range').ionRangeSlider({
        type:'double',
        min:80,
        max:128,
        step:4,
        grid:true,
        grid_snap:true,
        from:84,
        to:104

    });

    /**
     * Render the Tree of Categories
     * @type {{}}
     */

    var selected={};
    var treeObject=$('#tree');
    var h5=$('#myModal').find('h5');
    var input=$("<input/>",{
        type:'hidden',
        name:'parent_id',
        value:null
    });

    var btnCreate=$('#btnCreate');
    var categoryForm=$('#categoryForm');


    var loadTree=function(){
        $.get('/api/categories').done(function(response){
            treeObject.treeview({
                data:parse(response),
                expandIcon:'fa fa-folder-o',
                collapseIcon:'fa fa-folder-open-o',
                checkedIcon:'fa fa-check-circle-o',
                uncheckedIcon:'fa fa-circle-o',
                showTags:true,
                showCheckbox:true,
                onNodeSelected:function(e,node){
                    selected=node;
                },
                onNodeUnselected:function(e,data){
                    selected={};
                }
            });
            treeObject.treeview('collapseAll');
        });
    };

    var parse=function(data){
        var tree=[];
        $.each(data,function(index,value){
            var node={};
            node.text=value.name_ru;
            node.catId=value.id;
            if(value.children.length>0) {
                node.nodes = parse(value.children);
                node.tags=[value.children.length];
            }
            tree.push(node);
        });
        return tree;
    };

    loadTree();


    $('#myModal').modal({
        show:false,

    }).on('shown.bs.modal',function(){
        var $body=$(this).find('.modal-body');
        //  $body.empty();
        if(selected) {
            h5.text(selected.text);
            input.val(selected.catId);
            $body.prepend(h5);
            categoryForm.append(input);
        }

    }).on('hidden.bs.modal',function(){
        h5.text('');
        input.val('');
    });

    btnCreate.on('click',function(e){

        $.ajax({
            url:categoryForm.attr('action'),
            data:categoryForm.serializeArray(),
            type:'POST',
            dataType:'json'
        }).done(function(response){
            console.log(response);
        });
    });

    $('#fileupload').fileupload({
        dataType: 'json',
        formData: formData($('form')),
      }).on('fileuploaddone',function (e, data) {
        $.each(data.result.files, function (index, file) {
            $('<img/>',{
                src:file.path,
                width:160,
                height:226
            }).addClass('img-thumbnail').appendTo('#files');
        });
    }).on('fileuploadprogress',function(e,data){
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );

    });
});