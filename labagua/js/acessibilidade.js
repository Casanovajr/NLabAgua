function increaseFontSize() {
  document.body.classList.toggle('larger-text');
  // Salva a preferência do usuário no localStorage
  if (document.body.classList.contains('larger-text')) {
    localStorage.setItem('largerText', 'enabled');
  } else {
    localStorage.setItem('largerText', 'disabled');
  }
}

// Verifica a preferência do usuário ao carregar a página
window.onload = function () {
  if (localStorage.getItem('largerText') === 'enabled') {
    document.body.classList.add('larger-text');
  }
};

function decreaseFontSize() {
  var body = document.body;
  var currentSize = window.getComputedStyle(body, null).getPropertyValue('font-size');
  body.style.fontSize = (parseFloat(currentSize) - 1) + 'px';
}

function toggleContrast() {
  document.body.classList.toggle('high-contrast');
  if (document.body.classList.contains('high-contrast')) {
    localStorage.setItem('highContrast', 'enabled');
  } else {
    localStorage.setItem('highContrast', 'disabled');
  }
}

function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
  if (document.body.classList.contains('dark-mode')) {
    localStorage.setItem('darkMode', 'enabled');
  } else {
    localStorage.setItem('darkMode', 'disabled');
  }
}

function speakPageContent() {
  if ('speechSynthesis' in window) {
    var speech = new SpeechSynthesisUtterance(document.body.innerText);
    speech.lang = 'pt-BR';
    window.speechSynthesis.speak(speech);
  } else {
    alert('Seu navegador não suporta leitura de página.');
  }
}

function stopSpeaking() {
  if ('speechSynthesis' in window) {
    window.speechSynthesis.cancel();
  } else {
    alert('Seu navegador não suporta leitura de página.');
  }
}

// Verifica as preferências ao carregar a página
window.onload = function () {
  if (localStorage.getItem('highContrast') === 'enabled') {
    document.body.classList.add('high-contrast');
  }
  if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
  }
};

function toggleAccessibilityBar() {
  var bar = document.querySelector('.accessibility-bar');
  bar.classList.toggle('expanded');
}