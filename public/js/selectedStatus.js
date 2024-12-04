const selects = document.querySelectorAll("#statusSelect"); // atau ".status-select select" jika menggunakan class

selects.forEach((select) => {
  function updateStatus() {
    select.className = "focus:outline-none " + select.value;
  }

  select.addEventListener("change", updateStatus);
  updateStatus(); // Set initial state
});
