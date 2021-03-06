
$(function() {
  loadPage(1);
});
function loadPage(page){
    var query=$("#q").val();
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $.ajax({
        url:'ajax/list_products.php',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("Loading...");
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

$('#editProductModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') 
  $('#edit_id').val(id)
  var name = button.data('name') 
  $('#edit_name').val(name)
  var category = button.data('category') 
  $('#edit_category').val(category);//html("<option value=" + 1 + ">" + category + "</option>");
  var stock = button.data('stock') 
  $('#edit_stock').val(stock)
  var price = button.data('price') 
  $('#edit_price').val(price)
  var photo = button.data('photo')  
  $('#currentPhoto').html("<label style='margin:20px;' for=''>Current Photo:</label><img width='200' height='200' src=../"+ photo+" alt=''>");
  var description = button.data('description')  
  $('#edit_description').val(description)
  var tech = button.data('tech')  
  $('#edit_tech').val(tech)
  var video = button.data('video')  
  $('#edit_video').val(video)
  var supplier = button.data('supplier')  
  $('#edit_supplier').val(supplier)
  
})

$('#deleteProductModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') 
  $('#delete_id').val(id)
})


$('#saveEdit').click(function() {
  $( "#edit_product" ).submit(function(e) {
    e.preventDefault();
    let parametros=$(this).serialize();
  
      $.ajax({
          url: "edit_product.php",
          type: "POST",
          dataType: 'json',
          encoding:"UTF-8",
          data: parametros,
          beforeSend: function(objeto){
             $("#resultados").html("Enviando...");
          },
          success: function(datos){
              swal({
                type:'success',
                title:'Product Update successfully!'
              })
          $("#resultados").html(datos);
          loadPage(1);
          $('#editProductModal').modal('hide');
        },
        error: function(resp) {
          alert(resp.responseText);
        } 
      });   
  });
});

 $('#saveStore').click(function() { // investigar como enviar imagnes de un file campo con post yq que sea con ajax
  $( "#add_product" ).submit(function(e)  {
    e.preventDefault();
    let parametros = new FormData($(this)[0]);
    
      $.ajax({
          url: "ajax/save_product.php",
          type: "POST",
          dataType:'json',
          data: parametros,
          contentType: false, 
          processData: false,
          beforeSend: function(objeto){
            $("#resultados").html("Enviando...");
          }
        }).done(function(resp){
            if(!resp.error){
              // $('body').removeClass('modal-open');
              $('.modal-backdrop').remove(); // removemos el fondo oscuro
              $('#addProductModal').modal('hide');
              $("#resultados").html("<div class='alert alert-success'><strong>Success! </strong>"+resp.msg+"<button type='button' class='close' data-dismiss='alert'>&times;</button></div>");
              loadPage(1);
              setTimeout(function(){
              $("#resultados").html(null);
              },4000)
            }
            else if(resp.error){
              swal({
                type:'error',
                title: 'Error: '+resp.msg,
              })
            }
        }).fail(function(resp){
          swal({
            type: 'error',
            title:'Error!',
            text:resp.responseText,
          })
          console.log(resp.responseText);
        })
  });
 });
 
$( "#delete_product" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "ajax/del_product.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              }
            }).done(function(datos){
              swal('Product Delete!','','success');
              // $('body').removeClass('modal-open') 
              $('.modal-backdrop').remove();
              $("#deleteProductModal").modal('toggle'); 
              loadPage(1);
            }).fail(function(resp){
              $("#resultados").html(resp.responseText);
            })
  event.preventDefault();
});

