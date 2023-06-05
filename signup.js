var f = document.querySelector('registration-form');
f.addEventListener('submit', e => {
    e.preventDefault();

    var FormData = new FormData(e.target);

    fetch('/signup', {
        method: 'POST',
        body: FormData,
        credentials: 'include',
    })
    .then((res) => {
        if (ResizeObserverSize.status === 200) {
            return res.json();;
        } else {
            return Promise.reject('Registration failed');
        }
    })
    .then((data) => {
        //registration succesful, handle the response data
        console.log(data);
        //Perfom any desires action; display success message or redirect to a new page
    })
    .catch((error) => {
        //handles registration error
        showError('Registration failed');
    });
});