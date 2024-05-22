var contactFirstName = document.getElementById("contactFirstName");
var contactLastName = document.getElementById("contactLastName");
var contactPhone = document.getElementById("contactPhone");
var contactAddress = document.getElementById("contactAddress");
var contactEmail = document.getElementById("contactEmail");
var contactNotes = document.getElementById("contactNotes");
var contactForm = document.getElementById("contactForm");

var firstNameAlert = document.getElementById("firstNameAlert");
var lastNameAlert = document.getElementById("lastNameAlert");
var phoneAlert = document.getElementById("phoneAlert");
var addressAlert = document.getElementById("addressAlert");
var emailAlert = document.getElementById("emailAlert");
var notesAlert = document.getElementById("notesAlert");

contactForm.addEventListener("submit", addContact);

function addContact(e) {
  e.preventDefault();

  if (
    !validateContact(
      contactFirstName.value,
      contactLastName.value,
      contactPhone.value,
      contactAddress.value,
      contactEmail.value,
      contactNotes.value
    )
  ) {
    return false;
  }

  // Continue with form submission
  contactForm.submit();
}

function validateContact(firstName, lastName, phone, address, email, notes) {
  var isValid = true;

  if (firstName.trim() === "") {
    firstNameAlert.innerHTML =
      '<div class="alert alert-danger" role="alert">First name is required</div>';
    isValid = false;
  } else {
    firstNameAlert.innerHTML = "";
  }

  if (lastName.trim() === "") {
    lastNameAlert.innerHTML =
      '<div class="alert alert-danger" role="alert">Last name is required</div>';
    isValid = false;
  } else {
    lastNameAlert.innerHTML = "";
  }

  if (phone.trim() === "") {
    phoneAlert.innerHTML =
      '<div class="alert alert-danger" role="alert">Phone is required</div>';
    isValid = false;
  } else {
    phoneAlert.innerHTML = "";
  }

  if (address.trim() === "") {
    addressAlert.innerHTML =
      '<div class="alert alert-danger" role="alert">Address is required</div>';
    isValid = false;
  } else {
    addressAlert.innerHTML = "";
  }

  if (email.trim() === "") {
    emailAlert.innerHTML =
      '<div class="alert alert-danger" role="alert">Email is required</div>';
    isValid = false;
  } else {
    emailAlert.innerHTML = "";
  }

  if (notes.trim() === "") {
    notesAlert.innerHTML =
      '<div class="alert alert-danger" role="alert">Notes are required</div>';
    isValid = false;
  } else {
    notesAlert.innerHTML = "";
  }

  return isValid;
}