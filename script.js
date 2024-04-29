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

// Dropdown Functions
const menuDropdown = () => {
  const menuElement = document.querySelector("#menu-dropdown");

  // Periksa apakah dropdown sudah terlihat
  const isVisible = !menuElement.classList.contains("hidden");

  // Jika dropdown sudah terlihat, sembunyikan
  if (isVisible) {
    menuElement.classList.add("hidden");
  } else {
    // Jika dropdown belum terlihat, tampilkan
    menuElement.classList.remove("hidden");
  }
};

// Fungsi untuk menutup dropdown
const closeDropdown = () => {
  const menuElement = document.querySelector("#menu-dropdown");
  menuElement.classList.add("hidden");
};

// Fungsi untuk mengecek apakah elemen yang diklik adalah dropdown atau bukan
const isClickedInsideDropdown = (target) => {
  const menuElement = document.querySelector("#parent-dropdown");
  return menuElement.contains(target);
};

// Event listener untuk mendengarkan setiap kali dokumen diklik
document.addEventListener("click", (event) => {
  // Jika elemen yang diklik berada di luar dropdown, tutup dropdown
  if (!isClickedInsideDropdown(event.target)) {
    closeDropdown();
  }
});
// End Dropdown Functions
