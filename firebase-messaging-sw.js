importScripts('https://www.gstatic.com/firebasejs/5.5.8/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.5.8/firebase-messaging.js');

var config = {
    apiKey: "AIzaSyDvwfzt27SH5i7aWiAtaqVX7-AAG0tBRQI",
    authDomain: "ezzly-97f91.firebaseapp.com",
    databaseURL: "https://ezzly-97f91.firebaseio.com",
    projectId: "ezzly-97f91",
    storageBucket: "ezzly-97f91.appspot.com",
    messagingSenderId: "279108952591"
  };
  firebase.initializeApp(config);
  
  // Retrieve Firebase Messaging object.
const messaging = firebase.messaging();


messaging.setBackgroundMessageHandler(function(payload) {
    
 var  title =payload.data.title;
  
 var options ={
        body: payload.data.body,
        icon: payload.data.icon,
        image: payload.data.image,
     data:{
            time: new Date(Date.now()).toString(),
            click_action: payload.data.click_action
        }
      
  };
 return self.registration.showNotification(title, options);

  
});


self.addEventListener('notificationclick', function(event) {

   var action_click=event.notification.data.click_action;
  event.notification.close();

  event.waitUntil(
    clients.openWindow(action_click)
  );
});
