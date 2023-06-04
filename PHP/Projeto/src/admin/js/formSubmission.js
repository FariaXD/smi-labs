function submitForm(userId, submitAction, formData) {
  var url;
  if (submitAction === "Update") {
    url = "processUpdateUser.php?idUser=" + userId;
  } else if (submitAction === "Delete") {
    url = "processDeleteUser.php?idUser=" + userId;
  } else {
    return; // Do nothing if neither update nor delete is selected
  }
  SubmitFormData(url, formData);
}

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

function submitCategoryChange(submitAction, formData){
  var url;
  if (submitAction === "Update") {
    url = "processUpdateCategory.php?delete=" + 0;
  } else if (submitAction === "Delete") {
    url = "processUpdateCategory.php?delete=" + 1;
  } else {
    return; // Do nothing if neither update nor delete is selected
  }
  SubmitFormData(url, formData);
}
