function switchTheme() {
    return {
        Light: localStorage.getItem('lightmode') === 'true',
        toggleTheme() {
            this.Light = !this.Light;
            localStorage.setItem('lightmode', this.Light);
        }
    }
}

$('img').lazy({
    effect: 'fadeIn',
    visibleOnly: true,
    onError: function(element) {
        console.log('error loading ' + element.data('src'));
    }
});