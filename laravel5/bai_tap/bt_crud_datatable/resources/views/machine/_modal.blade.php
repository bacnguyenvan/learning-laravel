<div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6>Vui lòng chọn 1 nhóm</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary select_of_model mr-2">Thực hiện</button>
                   
                        <button class="btn btn-outline-secondary mr-2">Chọn tất cả</button>
                   
                        <button class="btn btn-outline-secondary">Bỏ chọn</button>
                    </div>
                
                </div>
            </div>
            <div class="modal-footer" style="justify-content:flex-start">   
                {!! \App\Group::getListGroup(true) !!} 
            </div>
        </div>
    </div>
</div>


