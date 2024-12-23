document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("fanForm");

  form.addEventListener("submit", (e) => {
    const name = document.getElementById("name").value.trim();
    const gender = document.querySelector('input[name="gender"]:checked');
    const fandomLevel = document.getElementById("fandom_level").value;

    if (!name || !gender || !fandomLevel) {
      alert("Please fill out all required fields!");
      e.preventDefault();
    }
  });
});
