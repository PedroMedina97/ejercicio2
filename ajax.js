$(document).ready(function () {
  $(".upload").on("click", function (e) {
    e.preventDefault();
    var formData = new FormData();
    var title = $("#title").val();
    var description = $("#description").val();
    var files = $("#image")[0].files[0];

    formData.append("title", title);
    formData.append("description", description);
    formData.append("file", files);
    $.ajax({
      url: "http://localhost/ejercicio2/controlador.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        data = JSON.parse(response);
        showLoading();
        if (data.res == true) {
          Swal.fire({
            icon: "success",
            title: data.msg,
            showConfirmButton: false,
            timer: 2000,
          }).then(function () {
            //location.href = "http://localhost/ejercicio2/";
          });
        } else {
          Swal.fire({
            icon: "error",
            title: data.msg,
            showConfirmButton: false,
            timer: 1500,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: data.msg,
          showConfirmButton: false,
          timer: 1500,
        });
      },
    });
  });
  
    $("#load").click(function(e){
      e.preventDefault();
      $.ajax({
        type: "GET",
        url: 'http://localhost/ejercicio2/controlador.php',
        contentType: 'application/json',
        async:true,
        beforeSend: showLoading(),
        success:function(response){
          
          data = JSON.parse(response);
          if(data){
            Swal.fire({
              icon: "success",
              title: "Data Loaded",
              showConfirmButton: false,
              timer: 1500,
            });
          }
          /* console.log(data); */
          data.forEach(function(data) {
            $("#items")
            .append('<li class="list-group-item shadow p-3 mb-5 bg-body-tertiary rounded card-up">'
            +"<img src="+data.url+" width='100' height='100%' class='img-fluid img-thumbnail'>"
            +"<h3 class='ml-3' style='display: inline-block;'>"+data.title+"<h3/>"+
             "<p >"+data.description+"<p/>"+
            '</li>');
            
          
          });
        },error: function(error){
          data = JSON.parse(error);
          console.log(data);
        }
      });
    })

    function showLoading() {
      Swal.fire({
        title: "Espere un momento",
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        },
      });
    }
});
