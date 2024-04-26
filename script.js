// Tabs Functions
window.onload = function () {
  // Menandai tab Details sebagai aktif secara default saat halaman dimuat
  document.getElementById("details").style.display = "block";
  document.querySelector(".tablinks.active").classList.remove("active"); // Hapus kelas 'active' dari tab sebelumnya
  document
    .querySelector("[onclick=\"tab(event, 'details')\"]")
    .classList.add("active"); // Tambahkan kelas 'active' ke tab Details
};

const tab = (evt, cityName) => {
  let i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
};
// End Tabs Functions

// Modal Functions
const showModal = () => {
  const element = document.querySelector("#modal");

  element.classList.replace("hidden", "block");
};

const hiddenModal = () => {
  const element = document.querySelector("#modal");

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
