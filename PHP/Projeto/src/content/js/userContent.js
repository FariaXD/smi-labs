function SubmitFormData(url, formData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.onload = function () {
      // Handle AJAX response
      console.log(xhr.responseText);

      // Refresh the page after a delay
      setTimeout(function () {
        location.reload();
      }, 1000); // Refresh after 2 seconds (adjust the delay as needed)
    };
    xhr.send(formData);
}
