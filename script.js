function submitForm() {
  var formData = {
    username: $('#username').val(),
    email: $('#email').val(),
    password: $('#password').val(),
  };

  $.ajax({
    type: 'POST',
    url: 'cusregister.php',
    data: formData,
    dataType: 'json',
    encode: true,
  }).done(function (data) {
    console.log(data.message);
    // You can perform additional actions here if needed
  });
}
