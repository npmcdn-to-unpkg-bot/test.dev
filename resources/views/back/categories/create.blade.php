<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="CreateCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Создать категорию</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('api.categories.store')}}" method="post" id="formCategoryStore">
                    {{csrf_field()}}
                <div class="form-group">
                    <label class="control-label">Eng</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label class="control-label">Ru</label>
                    <input type="text" class="form-control" name="name_ru">
                </div>
                <div class="form-group">
                    <label class="control-label">Parent category</label>
                    <select class="form-control" name="parent_id">
                        <option value="">Select parent...</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name_ru}}</option>
                            @endforeach
                    </select>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="btnCategoryStore" >Создать</button>
            </div>
        </div>
    </div>
</div>

