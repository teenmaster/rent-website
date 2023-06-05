var f = document.querySelector('#signup');
f.addEventListener('submit', e => {
    e.preventDefault();


fetch('/signin', {
    method: 'POST',
    body: new FormData(e.target),
    credentials: 'include',
})
  .then((res) => {
    if (res.status == 200){
        return Promise.resolve();
    }else {
        return Promise.reject('Sign-in failed');
    }
  })
  .then((profile) => {
    if (window.PasswordCredential){
        var c = new PasswordCredential(e.target);
        return navigator.credentials.store(c);
    } else {
        return Promise.resolve(profile);
    }
  })
  .then((profile) => {
    if (profile) {
        updateUI(profile);
    }
  })
  .catch((error) => {
    showError('Sign-in faild');
  });
});