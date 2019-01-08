function addProductValidate(){
  var name = $("input[name=name]").val();
  var description = $('textarea[name="description"]').val();
  // var image = $("input[name=image]").val();
  var price = $("input[name=price]").val();
  var category = $('select[name="category"] option:selected').val();
  var status = $("input[name='status']:checked").val();
  var image = document.getElementById("image");
  var isSuccsess = true;
  // console.log(image);
  if (name == "") {
    $("#checkName").html("Please input name");
    isSuccsess = false;
  } else {
    $("#checkName").html("");
  }
  if (description == "") {
    $("#checkDescription").html("Please input description");
    isSuccsess = false;
  } else {
    $("#checkDescription").html("");
  }
  if (price == "") {
    $("#checkPrice").html("Please input the price");
    isSuccsess = false;
  } else {
    $("#checkPrice").html("");
  }
  if (category == "") {
    $("#checkCategory").html("Please input the category");
    isSuccsess = false;
  } else {
    $("#checkCategory").html("");
  }
  if (!status) {
    $("#checkStatus").html("Please input the status");
    isSuccsess = false;
  } else {
    $("#checkStatus").html("");
  }
  if (!validateImage(image)) {
    $("#checkImage").html("Please input the image");
    isSuccsess = false;
  } else {
    $("#checkImage").html("");
  }
  return isSuccsess;

}
$('#save').click(function(){
  addProductValidate();
});


function validateImage(x){
  if ('files' in x) {
    if (x.files.length == 0) {
      return false;
    } else {
      for (var i = 0; i < x.files.length; i++) {
        var file = x.files[i];        
        if ('size' in file) {
          if (file.size > 500000) {
            return false;
          }
        }
      }
    }
  } 
  else {
    if (x.value == "") {
      return false;
    } else {
      return false;
    }
  }
  return true;

}