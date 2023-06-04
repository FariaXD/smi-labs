
document
  .getElementById("publish_series").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData();
    var form = document.getElementById("publish_series");

    // Retrieve form input values and append them to the FormData object
    formData.append("type", "Series");
    formData.append("name", form.elements.name.value);
    formData.append("episodeNumb", form.elements.episodeNumb.value);
    var selectElement = document.getElementById("select_categories_series");
    var selectedCategories = selectElement.selectedOptions;
    for (var i = 0; i < selectedCategories.length; i++) {
      var option = selectedCategories[i];
      formData.append("selectedCategories[]", option.value);
    }
    formData.append("private", form.elements.private.value);
    // Append the file to the FormData object
    var fileInput = form.elements.content;
    var file = fileInput.files[0]; // Get the first selected file
    formData.append("content", file);
    // Show the confirmation modal
    $("#confirmationModalSeries").modal("show");

    // Assign the submitForm function to the Confirm button
    document
      .getElementById("confirmationModalSeries")
      .querySelector("button.btn-primary").onclick = function () {
      SubmitFormData("processPublishContent.php", formData);
    };
  });

document
  .getElementById("publish_movie").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData();
    var form = document.getElementById("publish_movie");

    // Retrieve form input values and append them to the FormData object
    formData.append("type", "Movie");
    formData.append("name", form.elements.name.value);
    formData.append("episodeNumb", 0);
    var selectElement = document.getElementById("select_categories_movie");
    var selectedCategories = selectElement.selectedOptions;
    for (var i = 0; i < selectedCategories.length; i++) {
      var option = selectedCategories[i];
      formData.append("selectedCategories[]", option.value);
    }
    formData.append("private", form.elements.private.value);

    // Append the file to the FormData object
    var fileInput = form.elements.content;
    var file = fileInput.files[0]; // Get the first selected file
    formData.append("content", file);

    // Show the confirmation modal
    $("#confirmationModalMovies").modal("show");

    // Assign the submitForm function to the Confirm button
    document
      .getElementById("confirmationModalMovies")
      .querySelector("button.btn-primary").onclick = function () {
      SubmitFormData("processPublishContent.php", formData);
    };
  });
               
function SubmitFormData(url, formData) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.onload = function () {
    // Handle AJAX response
    console.log(xhr.responseText);

    // Refresh the page after a delay
    //setTimeout(function () {
    //  location.reload();
    //}, 1000); // Refresh after 2 seconds (adjust the delay as needed)
  };
  xhr.send(formData);
}