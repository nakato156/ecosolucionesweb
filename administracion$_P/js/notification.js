const PUBLIC_VAPID_KEY = 'BJKaDByF8QAYVNxwSdEbJYpCZgZZrvmq7pf2WvJyy-TYib32_Y5L9FmtTQ5481NAZwoXImNTn57N6LLSkdhP8J4';

function urlBase64ToUint8Array(base64String) {
  const padding = "=".repeat((4 - (base64String.length % 4)) % 4);
  const base64 = (base64String + padding).replace(/-/g, "+").replace(/_/g, "/");

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

const subscription = async () => {
  // subscribe Service Worker
  const registro = await navigator.serviceWorker.register("http://localhost:8000/Page-ecosolwebtel/administracion$_P/js/sw.js"); //Poner la ruta de acuerdo al servidor 
  console.log("service worker registrado")

  // Listen Push Notifications
  const subscription = await registro.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: urlBase64ToUint8Array(PUBLIC_VAPID_KEY)
  });

 console.log(subscription);
  // Send Notification
  await fetch("https://server-notif.herokuapp.com/subs", {
    method: "POST",
    body: JSON.stringify(subscription),
    headers: {
      "Content-Type": "application/json"
    }
  });
  console.log("Suscrito!");
};
subscription();