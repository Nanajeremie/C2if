
function addForm(parent,type,label){
    var input = '<div class="form-group col-12 col-sm-12 col-md-6 col-lg-4"><input type="text" class="form-control" value="'+label+'"/> </div>';
    document.querySelector("#"+parent).innerHTML+=input;
}