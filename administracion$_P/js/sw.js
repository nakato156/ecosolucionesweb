console.log('service worker active');
self.addEventListener('push', e=>{
    const data = e.data.json()
    self.registration.showNotification(data.title,{
        body: data.message,
        icon: 'https://ecosolucionesweb.com/img/logo.png'
    })
})