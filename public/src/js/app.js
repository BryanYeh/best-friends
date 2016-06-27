$('.edit-link').on('click', function(event){
   event.preventDefault();
   var postBody = event.target.parentNode.parentNode.childNodes[1].textContent;
   $('#post-body').val(postBody);
   $('#edit-modal').modal();
});
