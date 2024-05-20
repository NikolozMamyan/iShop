const authBtn = document.getElementById('connect_btn');
const detailDiv = document.getElementById('detailDiv');
let isDetailVisible = false;

authBtn.addEventListener('click', (e) => {
  e.preventDefault();
  containerAdd();
});

function containerAdd() {
  if (isDetailVisible) {
    detailDiv.innerHTML = '';
    detailDiv.classList.remove("detailWeather");
    isDetailVisible = false;
    authBtn.innerHTML = 'Connectez-vous';
  } else {
    detailDiv.innerHTML = `
      <ul>
        <li><a class="dropdown-item mt-1 me-5 text-dark" href="/login">Identifiez-vous</a></li>
        <li><a class="dropdown-item mt-1 me-5 text-dark" href="/register">Créer votre compte</a></li>
      </ul>
    `;
    isDetailVisible = true;
    authBtn.innerHTML = 'x<span></span>';
    detailDiv.classList.add("detailWeather");
  }
}