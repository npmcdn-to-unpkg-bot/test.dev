$('document').ready(function(){

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

    $('#records-table').DataTable({
        ajax:{
            url:'/api/products',
            dataSrc:''
        },
        columns: [
            { "data": "id" },
            { "data": "model" },
            { "data": "article" } ,
            { "data":  "published" },
            { "data":  "new" }
        ]
    });

    $('#select-category').selectize();
    $('#select-material').selectize();
    $('#select-season').selectize();
    $('#select-new').selectize();

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


     // ---------------STORE THE PRODUCT-----------------------------------



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
        }).error(function(errors){
            console.log(errors);
        });

    });

    //----------------WORK WITH TREE OF CATEGORY------------------------

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


});