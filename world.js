window.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("country");
  const result = document.getElementById("result");

  function search(extra = "") {
    const url = `world.php?country=${encodeURIComponent(input.value.trim())}${extra}`;
    fetch(url)
      .then((res) => res.text())
      .then((html) => {
        result.innerHTML = html;
      })
      .catch((err) => {
        result.textContent = "Error: " + err;
      });
  }

  document.getElementById("lookup").addEventListener("click", () => search());
  document
    .getElementById("lookup-cities")
    .addEventListener("click", () => search("&lookup=cities"));
});
