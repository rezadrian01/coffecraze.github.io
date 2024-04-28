const tab = (evt, cityName, id) => {
  let i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName(`tab-content${id}`);
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName(`tablinks${id}`);
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
};
// End Tabs Functions

// Modal Functions
const showModal = (id) => {
  const element = document.querySelector(`#modal${id}`);

  element.classList.replace("hidden", "block");
};

const hiddenModal = (id) => {
  const element = document.querySelector(`#modal${id}`);

  element.classList.replace("block", "hidden");
};
// End Modal Functions

// Get Year now for footer
document.querySelector("#year").innerHTML = new Date().getFullYear();
// End Get Year now for footer

// Cart Functions
const getQty = document.querySelector("#qty");
let i = 1;
getQty.innerHTML = i;

const increment = () => {
  getQty.innerHTML = ++i;
};

const decrement = () => {
  if (i !== 1) {
    getQty.innerHTML = --i;
  } else {
    return i;
  }
};
// End Cart Functions
