const registerSakamataCaptcha = function (elementId, endpoint, formNameS = 'scaptchasd', seed = null) {
    const img = document.getElementById(elementId);
    const s = new Int32Array(1);
    self.crypto.getRandomValues(s);
    const sd = seed === null ? (s[0] == 0 ? 1 : Math.abs(s[0])) : seed;
    img.src = endpoint + (endpoint.endsWith('/') ? '' : '/') + 'image.php?seed=' + sd.toString();
    (() => {
        const e = document.createElement('input')
        e.type = 'hidden';
        e.value = sd;
        e.name = formNameS;
        e.id = formNameS
        img.parentElement.appendChild(e);
    })();
}