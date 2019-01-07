<!DOCTYPE html>
<html>
    <head>
        <title>FCM Javascript push & Send Notification</title>
        <link rel="manifest" href="manifest.json">
         <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-messaging.js"></script>
<script>
  // Initialize Firebase
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

messaging.requestPermission().then(function() {
  //console.log('Notification permission granted.');
  
 if(isTokenSentToServer()){
      
    // console.log("Token Already sent");
  }else{
      getRegisterToken();
 }
  
  // TODO(developer): Retrieve an Instance ID token for use with FCM.
  // ...
}).catch(function(err) {
  console.log('Unable to get permission to notify.', err);
});


function getRegisterToken(){
    // Get Instance ID token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
messaging.getToken().then(function(currentToken) {
  if (currentToken) {
       saveToken(currentToken);
      console.log(currentToken);
    sendTokenToServer(currentToken);
   // updateUIForPushEnabled(currentToken);
  } else {
    // Show permission request.
    console.log('No Instance ID token available. Request permission to generate one.');
    // Show permission UI.
   // updateUIForPushPermissionRequired();
    setTokenSentToServer(false);
  }
}).catch(function(err) {
  console.log('An error occurred while retrieving token. ', err);
  //showToken('Error retrieving Instance ID token. ', err);
  setTokenSentToServer(false);
});
}

 function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  }
  
  function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log('Sending token to server...');
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }
  }
  function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
  }
  
  function saveToken(currentToken){
      
       jQuery.ajax({
         data: {"token":currentToken},
         type: "post",
         url: "savefcmtoken.php",
         success: function(result){
             console.log(result);
         }
        
    });
  }

messaging.onMessage(function(payload) {
  //console.log('Message received. ', payload);
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
  var myNotification = new Notification(title, options);
});


</script>
    </head>
    <body><center><h1>FCM Web Push Notification using Javascript </h1>
    <h3>Part-6: FCM  Push Notifications Custom click_action payload</h3></center>
    </body>
</html>