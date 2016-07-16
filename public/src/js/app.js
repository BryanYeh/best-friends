/* Post */

var postId = 0;
postBodyElement = null;

$('.edit-link').on('click', function(event){
   event.preventDefault();
   postBodyElement = event.target.parentNode.parentNode.childNodes[1];
   var postBody = postBodyElement.textContent;
   postId = event.target.parentNode.parentNode.dataset['postid'];
   $('#post-body').val(postBody);
   $('#edit-modal').modal();
});

$('#modal-save').on('click', function(){
   $.ajax({
      method: 'POST',
      url: urlEdit,
      data: { body: $('#post-body').val(), postId: postId, _token: token}
   })
   .done(function(msg){
      $(postBodyElement).text(msg['new-body']);
      $('#edit-modal').modal('hide');
   });
});

$('.like').on('click', function(event){
   event.preventDefault();
   postId = event.target.parentNode.parentNode.dataset['postid'];
   var isLike = event.target.previousElementSibling == null;
   $.ajax({
      method: 'POST',
      url: urlLike,
      data: {isLike: isLike, postId: postId, _token: token}
   }).done(function(){
      event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like'
         : event.target.innerText == 'Hate' ? 'You hate this post' : 'Hate';
      if(isLike){
         event.target.nextElementSibling.innerText = 'Hate';
      }
      else{
         event.target.previousElementSibling.innerText = 'Like';
      }
   });
});


/* Friends */

// Friend request cancel
$('.cancelRequest').on('click', function(event) {
   event.preventDefault();
   var email = event.target.parentNode.dataset['friendemail'];
   $.ajax({
      method: 'POST',
      url: urlCancelRequest,
      data: {email: email, _token: token}
   }).success(function () {
      console.log(event.target.textContent);
      $(event.target).removeClass('cancelRequest').addClass('request');
      event.target.textContent = 'Request Friend';
   });
});

// Friend request
$('.request').on('click', function (event) {
   event.preventDefault();
   var email = event.target.parentNode.dataset['friendemail'];
   $.ajax({
      method: 'POST',
      url: urlRequest,
      data: {email: email, _token: token}
   }).success(function () {
      console.log(event.target.textContent);
      $(event.target).removeClass('request').addClass('cancelRequest');
      event.target.textContent = 'Cancel Friend Request';
   });
});