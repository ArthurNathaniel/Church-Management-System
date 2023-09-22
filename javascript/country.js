const countryDropdown = document.getElementById("country");
fetch("https://restcountries.com/v2/all")
  .then((response) => response.json())
  .then((data) => {
    data.forEach((country) => {
      const option = document.createElement("option");
      option.textContent = country.name; // Set the option text to the country name
      countryDropdown.appendChild(option);
    });
  })
  .catch((error) => console.error(error));
