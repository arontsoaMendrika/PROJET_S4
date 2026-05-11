// Shared auth JS: validation, IMC/BMI calc, password toggle, error rendering
(function(){
  function qs(id){return document.getElementById(id)}

  // Helper to show field error
  function showError(id, msg){
    const el = qs('error-'+id);
    if (el) el.textContent = msg || '';
    else if (msg) alert(msg);
  }

  // Signup form
  const signup = qs('signup-form');
  if (signup){
    // password toggle
    const toggle = qs('toggle-password');
    if (toggle){
      toggle.addEventListener('click', function(){
        const pass = qs('password');
        if (!pass) return;
        if (pass.type === 'password'){ pass.type = 'text'; toggle.textContent = 'Masquer'; }
        else { pass.type = 'password'; toggle.textContent = 'Afficher'; }
      });
    }

    signup.addEventListener('submit', function(e){
      // clear previous errors
      ['nom','prenom','naissance','email','telephone','pays','password','conditions'].forEach(id=>showError(id,''));
      let ok = true;
      const nom = qs('nom') && qs('nom').value.trim();
      const prenom = qs('prenom') && qs('prenom').value.trim();
      const naissance = qs('naissance') && qs('naissance').value;
      const email = qs('email') && qs('email').value.trim();
      const telephone = qs('telephone') && qs('telephone').value.trim();
      const pays = qs('pays') && qs('pays').value;
      const password = qs('password') && qs('password').value;
      const conditions = qs('conditions') && qs('conditions').checked;

      if (!nom){ showError('nom','Le nom est requis.'); ok=false; }
      if (!prenom){ showError('prenom','Le prenom est requis.'); ok=false; }
      if (!naissance){ showError('naissance','La date de naissance est requise.'); ok=false; }
      if (!email || !email.includes('@')){ showError('email','Email invalide.'); ok=false; }
      if (!telephone){ showError('telephone','Telephone requis.'); ok=false; }
      if (!pays){ showError('pays','Veuillez choisir un pays.'); ok=false; }
      if (!password || password.length < 8 || !/[A-Z]/.test(password) || !/\d/.test(password)){
        showError('password','Mot de passe: min 8 caractères, 1 majuscule et 1 chiffre.'); ok=false;
      }
      if (!conditions){ showError('conditions','Vous devez accepter les conditions.'); ok=false; }

      if (!ok) e.preventDefault();
    });
  }

  // Login form
  const login = qs('login-form');
  if (login){
    login.addEventListener('submit', function(e){
      const email = qs('email') && qs('email').value.trim();
      const pass = qs('password') && qs('password').value;
      if (!email || !email.includes('@')){ e.preventDefault(); alert('Veuillez saisir un email valide'); return; }
      if (!pass){ e.preventDefault(); alert('Veuillez saisir votre mot de passe'); }
    });
  }

  // Health form (IMC)
  const health = qs('health-form');
  if (health){
    // calc button handler
    const calc = qs('calc-imc');
    const out = qs('imc-result');
    function computeIMC(){
      const t = parseFloat(qs('taille').value);
      const p = parseFloat(qs('poids').value);
      if (!t || !p) return null;
      const m = p / ((t/100)*(t/100));
      return m;
    }
    if (calc){
      calc.addEventListener('click', function(){
        const m = computeIMC();
        if (!m){ out.textContent = 'Veuillez renseigner la taille et le poids.'; return; }
        const label = m < 18.5 ? 'Insuffisant' : m < 25 ? 'Normal' : m < 30 ? 'Surpoids' : 'Obésité';
        out.textContent = 'IMC: ' + m.toFixed(1) + ' (' + label + ')';
      });
    }

    // Validate on submit and attach BMI in a hidden input
    health.addEventListener('submit', function(e){
      const t = parseFloat(qs('taille').value);
      const p = parseFloat(qs('poids').value);
      if (!t || !p || t <= 0 || p <= 0){ e.preventDefault(); out.textContent = 'Taille et poids valides requis.'; return; }
      // ensure hidden imc input
      let hid = qs('imc_hidden');
      const m = computeIMC();
      if (!hid){ hid = document.createElement('input'); hid.type='hidden'; hid.name='imc'; hid.id='imc_hidden'; health.appendChild(hid); }
      hid.value = m ? m.toFixed(1) : '';
    });
  }
})();
