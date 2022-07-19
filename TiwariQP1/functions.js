/* Siddharth Tiwari, 9/30/20, Quarter Project

  The javascript file conttains many different functions, but all of them revolve around the availability of the cars.
  I use a RNG to come up with the cars that will available and unavailable. From this, the numerous other functions are
  able to run. This random number generation makes this page more realistic and complicated to program because some
  values become extraneous.

  Regex email validation from: https://ui.dev/validate-email-address-javascript/



*/

//Initalizes vars for the animate function
var imageObj = null;
var x = 0;
var context = null;
var animaton = setInterval(animateCar, 20);

//This is the process of the RNG which occurs when the page loads
window.onload = function(){
  //This is the number of cars that cannot be rented
  var rentedCarNums = getRandomInt(0,5);
  //This contains the ID of each car that cannot be rented. Each car is assigned an ID from 0-9 (Honda has "0", Ford has "1", etc.)
  var rentedCar = [];
  //This variable contains the string equivalent of the carID. This is used to reference ID's in the actual document whereas the other one is a random number.
  var rentedCarID;
  //This variable contains the imgID, used to reference the image src in the carDisplayTable.
  var rentedCarImgID;

  //This loop runs as many times as the "rentedCarNums" dictates
  for(var i = 0; i<=rentedCarNums; i++){
    //Every time it runs, it adds a new number which represents the ID of the car that cannot be rented
    rentedCar.push(getRandomInt(0,9));
    //After the program generates the random number of the unrentable car, it changes aspects of the webpage so that the user knows that it is not available. It goes through each car and changes aspects.
    for(var j = 0; j<10; j++){
      //If the randomly generated number equates to a specific ID (It must equate to one and only one)
      if(rentedCar[i] == j){
        //This sets the value of the ID's so that they can be implemented into JavaScript methods as actual IDs
        rentedCarID = rentedCar[i].toString();
        rentedCarImgID = "img"+ rentedCar[i].toString();

        //This method disables the radio option on the CARFORM MODAL BOX
        document.getElementById(rentedCarID).disabled = true;
        //This method changes the image to a "car with an X" on the main webpage
        document.getElementById(rentedCarImgID).src = "noCar.png";
      }
    }
  } 
  //Displays placeholder text on reload
  document.getElementById('placeholderText').style.display = 'inline-block';
}

//This generates the random number
function getRandomInt(min, range) {
	return Math.floor(Math.random() * Math.floor(range)) + min;
}  

// This displays the modal itself. All modals are hidden when the site loads. The user can open modals because of this function.
function showModal(modal){
  document.getElementById(modal).style.display = "block";
}

//This hides the modal if the user clicks on the grey 'x's at the top right of each modal
function closeModal(modal) {
  document.getElementById("carPreselect").style.visibility = "hidden";
  document.getElementById(modal).style.display = "none";
}

//This function is specific to the CARINFORMATION MODAl BOX. Since each box's information is displayed in the same div, the text inside of them cannot be predetermined in the "onload function"
//This function is run before showing the CARINFORMATION MODAL BOX so that each box contains the right images, text, and availability reminders
function dataSelector(id){
  //This contains all the names and image sources for each car. The index of each src or name correspond to the paramater "id" of this function
  var modelName = ["Honda","Ford","Toyota","Jeep","Kia","Porsche","BMW","Mercedes","Lexus","Tesla"];
  var carImg =["honda.jpg", "ford.jpg", "toyota.jpg", "jeep.jpg", "kia.jpg", "porsche.jpg", "bmw.jpg", "mercedes.jpg", "lexus.jpg", "tesla.png"];

  //This changes the header to the specified car name
  document.getElementById('carName').innerHTML = "Car Info: " + modelName[id];

  //This is used for the availability aspect of the CARINFORMATION MODAL BOX
  var rentedCarID = document.getElementById(id.toString());
  //If each id's corresponding radio box is disabled, then it hides the button to preselect car (preselectForm() function) and it displays text in the header of the CARINFORMATION MODAL BOX
  if(rentedCarID.disabled == true){
    document.getElementById('carAvailability').innerHTML= "NOT AVAILABLE!";
    document.getElementById('carPreselect').style.visibility = "hidden";
  } else{
    document.getElementById('carAvailability').innerHTML= "";
    document.getElementById('carPreselect').style.visibility = "visible";
  }

  //This draws an image corresponding to the "id" parameter
  var c = document.getElementById('imageCanvas');
	var ctx = c.getContext('2d');
	ctx.clearRect(0, 0, c.width, c.height);
  var imageObj = new Image();
  //Based on the "id", the JavaScript function draws from the carImg array to change the src of the image
	imageObj.src = carImg[id];
	imageObj.onload = function() {
    ctx.drawImage(imageObj, 0, 0);
  }

  //This switch statement is used to display the information inside of each CARINFORMATION MODAL BOX. Based on the ID selected, the corresponding information is displayed in the left column of the CARINFORMATION MODAL BOX
  switch(id){
    case 0:
      document.getElementById('carDescription').innerHTML = '<h3>2020 Honda Accord</h3>' + '<p>The Honda Accord is a series of automobiles manufactured by Honda since 1976, best known for its four-door sedan variant, which has been one of the best-selling cars in the United States since 1989. The Accord nameplate has been applied to a variety of vehicles worldwide, including coupes, station wagons, hatchbacks and a Honda Crosstour crossover.</p>' + 'Horsepower: 192 to 252 hp' + '<br>' + 'MPG: Up to 30 city / 38 highway' + '<br>' + 'Dimensions: 192" L x 73" W x 57" H' + '<br>' + 'Engine: 1.5 L 4-cylinder, 2.0 L 4-cylinder';
      break;
    case 1:
      document.getElementById('carDescription').innerHTML = '<h3>2019 Ford Fiesta</h3>' + '<p>The Ford Fiesta is a supermini marketed by Ford since 1976 over seven generations. It has been manufactured in the United Kingdom, Germany, Spain, Australia, Chile, Brazil, Argentina, Venezuela, Mexico, Taiwan, China, India, Thailand, and South Africa.</p>' + 'Horsepower: 120 to 197 hp' + '<br>' + 'MPG: Up to 27 city / 37 highway' + '<br>' + 'Curb weight: 2,537 to 2,720 lbs' + '<br>' + 'Transmission: 6-speed automatic, 5 & 6-speed manual';
      break;
    case 2:
      document.getElementById('carDescription').innerHTML = '<h3>2021 Toyota Corolla</h3>' + '<p>The Toyota Corolla is a line of subcompact and compact cars manufactured by Toyota. Introduced in 1966, the Corolla was the best-selling car worldwide by 1974 and has been one of the best-selling cars in the world since then. In 1997, the Corolla became the best selling nameplate in the world, surpassing the Volkswagen Beetle. Toyota reached the milestone of 44 million Corollas sold over twelve generations in 2016. The series has undergone several major redesigns.</p>' + 'Horsepower: 139 to 169 hp' + '<br>' + 'MPG: Up to 31 city / 40 highway' + '<br>' + 'Dimensions: 182" L x 70" W x 56-57" H' + '<br>' + 'Curb weight: 2,910 to 3,150 lbs';
      break;
    case 3:  
      document.getElementById('carDescription').innerHTML = '<h3>2021 Jeep Wrangler</h3>' + "<p>The Jeep Wrangler is a series of compact and mid-size (2-door Wrangler, and a longer wheelbase / 4-door Wrangler Unlimited) four-wheel drive off-road SUVs, manufactured by Jeep since 1986, and currently in its fourth generation. The Wrangler JL, the most recent generation, was unveiled in late 2017 and is produced at Jeep's Toledo Complex.</p>" + '<p>MPG: Up to 22 city / 29 highway</p>' + '<p>Towing capacity: 2,000 to 3,500 lbs</p>' +'<p>Horsepower: 260 to 285 hp</p>' + '<p>Curb weight: 3,970 to 4,449 lbs</p>';
      break;
    case 4:
      document.getElementById('carDescription').innerHTML = '<h3>2021 Kia Sportage</h3>' + '<p>The Kia Sportage is a compact SUV (classified as a compact crossover SUV since 2004) built by the South Korean manufacturer Kia Motors since 1993.</p>' + '<p>Dimensions: 176" L x 73" W x 64-65" H</p>' + '<p>Horsepower: 181 to 240 hp</p>' +'<p>MPG: Up to 23 city / 30 highway</p>' + '<p>Curb weight: 3,305 to 3,765 lbs</p>';
      break;
    case 5:
      document.getElementById('carDescription').innerHTML = '<h3>2021 Porsche 911</h3>' + '<p>The Porsche 911 (pronounced Nine Eleven or in German: Neunelfer) is a two-door, 2+2 high performance rear-engined sports car. Introduced in September 1964 by Porsche AG of Stuttgart, Germany. It has a rear-mounted flat-six engine and all round independent suspension. It has undergone continuous development, though the basic concept has remained unchanged. The engines were air-cooled until the introduction of the Type 996 in 1998, with the 993, produced from 1994–1998 model years, being the last of the air-cooled Porsche sports cars.</p>' + '<p>Horsepower: 379 to 640 hp</p>' + '<p>Curb weight: 3,354 to 3,790 lbs</p>' +'<p>Engine: 3.0 L 6-cylinder, 3.8 L 6-cylinder</p>' + '<p>Transmission: 8-speed automatic, 7-speed manual</p>';
      break;
    case 6:
      document.getElementById('carDescription').innerHTML = '<h3>2021 BMW 7 Series</h3>' + '<p>The BMW 7 Series is a full-size luxury sedan produced by the German automaker BMW since 1977. It is the successor to the BMW E3 "New Six" sedan and is currently in its sixth generation.</p>' + '<p>MPG: Up to 22 city / 29 highway</p>' + '<p>Horsepower: 335 to 600 hp</p>' +'<p>Curb weight: 4,244 to 4,855 lbs</p>' + '<p>Engine: 3.0 L 6-cylinder, 4.4 L V8</p>';
      break;
    case 7:  
      document.getElementById('carDescription').innerHTML = '<h3>Mercedes-AMG GT</h3>' + '<p>The Mercedes-AMG GT (C190 / R190) is a sports car produced in coupe and roadster bodystyles by German automobile manufacturer Mercedes-AMG. The car was introduced on 9 September 2014 and was officially unveiled to the public in October 2014 at the Paris Motor Show.[4] After the SLS AMG, it is the second sports car developed entirely in-house by Mercedes-AMG.</p>' + '<p>Engine	4.0 L M178 (Mercedes-AMG) twin-turbocharged V8</p>' + '<p>Transmission	7-speed AMG SPEEDSHIFT DCT dual-clutch</p>' +'<p>Wheelbase	2,630 mm (103.5 in)</p>' + '<p>Length	4,546 mm (179.0 in)</p>';
      break;
    case 8:
      document.getElementById('carDescription').innerHTML = '<h3>2021 Lexus ES</h3>' + '<p>The Lexus ES is a series of compact executive, then executive cars sold by Lexus, the luxury division of Toyota since 1989. Seven generations of the sedan have been introduced to date, each offering V6 engines and the front-engine, front-wheel-drive layout. The first five generations of the ES were built on the Toyota Camry platform, with the sixth and seventh generations more closely related to the Avalon.</p>' + '<p>MPG: Up to 43 city / 44 highway</p>' + '<p>Horsepower: 203 to 302 hp</p>' +'<p>Engine: 2.5 L 4-cylinder, 3.5 L V6</p>' + '<p>Towing capacity: 1,000 lbs</p>';
      break;
    case 9:   
      document.getElementById('carDescription').innerHTML = '<h3>2020 Tesla Model S</h3>' + '<p>The Tesla Model S is an all-electric five-door liftback sedan produced by Tesla, Inc., and was introduced on June 22, 2012. As of August 2020, the Model S Long Range Plus has an EPA range of 402 miles (647 km), higher than that of any other battery electric car.</p>' + '<p>Range: 348 to 402 mi battery-only</p>' + '<p>MPGe: Up to 121 city / 112 highway</p>' +'<p>Dimensions: 196" L x 77" W x 57" H</p>' + '<p>Curb weight: 4,883 to 4,941 lbs</p>';
      break;
  }

  //This changes the currentID on display. If the user decides to preselect their car, then this id is stored inside a hidden input so that other parts of this program can reference it later.
  document.getElementById("idStorage").innerHTML = "" + id.toString() + "";

  //after determining what will be inside of each div in the CAR INFORMATION MODAL BOX, the box is displayed
  showModal('carInfo');
}

//This function preselects the corresponding radio input inside the CARFORM MODAL BOX
function preselectForm(){
  //this function takes the id of the current modal box that is open from the hidden input
  var id = document.getElementById("idStorage").textContent;
  //with this id, the function is able to preselect a radio button
  document.getElementById(id).checked = true;
}

//This function is used to display the invoice itself and check if the inputs of the user are valid
function returnInvoice(){
  //this stores the input from the name input
  var name = document.getElementById('name').value;

  //If the name field is not filled...
  if(name == ""){
    //Sends an alert to the user
    alert("You did not input your name. Please try again. Press OK.");
    //prematurely exits function
    return;
  }

  //this stores the input from the email input
  var email = document.getElementById('email').value;
  //This if statement uses regex to see if the email contains an "@" and a period
  if(/\S+@\S+\.\S+/.test(email) == false){
    //alerts user
    alert("Your input for email was invalid. Please try again. Press OK.");
    //prematurely exits function
    return;
  }
  //this stores the duration that the user inputted (between 1-15)
  var duration =  document.getElementById('carDuration').value;
  //checks if number is whole and between bounds of input
  if (((duration*10)%10) != 0 || duration > 15 || duration < 1){
    alert("Your input for duration was invalid. Please enter a whole number between 1 and 15. Press OK.");
    //prematurely exits function
    return;
  }
  //This determines which radio input was selected
  var selectedCar = "";
  //this calls the entire radio input
  var selectionOfCars = document.getElementsByName('carSelect');

  //this goes through each radio input and checks if it was selected
  for(var i=0; i < selectionOfCars.length; i++){
    if(selectionOfCars[i].checked == true){
      //if it was selected, then it returns the value of that radio button to the selectedcar variable
      selectedCar = selectionOfCars[i].value;
       //This sets the value of the ID's so that they can be implemented into JavaScript methods as actual IDs
      rentedCarID = i.toString();
      rentedCarImgID = "img"+ i.toString();
      //This unchecks the selected car on the CARFORM MODAL BOX
      document.getElementById(rentedCarID).checked = false;
      //This method disables the radio option on the CARFORM MODAL BOX
      document.getElementById(rentedCarID).disabled = true;
      //This method changes the image to a "car with an X" on the main webpage
      document.getElementById(rentedCarImgID).src = "noCar.png";
    }
  }

  //If no car is selected...
  if(selectedCar == ""){
    //alerts user
    alert("You did not select a car. Please try again. Press OK.");
    //prematurely exits function
    return;
  }
  //This determines the type of car that was selected. It sets the price of each based on it's tier.
  var carType = 0;
  if (selectedCar == "Honda"|| selectedCar == "Ford"|| selectedCar == "Toyota"|| selectedCar == "Jeep"|| selectedCar == "Kia")
  {
    carType = 29.99;
  } else{
    carType = 49.99;
  }
  //calculates the payment based on the duration times the carType
  var payment = (carType*duration).toFixed(2);

  //Displays name and email
  document.getElementById('nameInvoice').innerHTML= "Name: " + name;
  document.getElementById('emailInvoice').innerHTML= "Email: " + email;

  //This block of code is used to determine the current date
  var d = new Date();
  var year = d.getFullYear();
  var month = d.getMonth() + 1;
  //The rental starts the next day
  var day = d.getDate() + 1;
  document.getElementById('carInvoice').innerHTML= "From " + month + "/" + day + "/" + year + " for " + duration + " days.";

  //Displays the selected car
  document.getElementById('durationInvoice').innerHTML= "You selected: " + selectedCar + ".";
  
  //displays the payment
  document.getElementById('paymentInvoice').innerHTML= "Balance: $" + payment + ".";

  //this closes the form after it is completed
  closeModal('carForm');
  //this displays the invoice in the bottom left of the screen and hides the placeholder text
  document.getElementById('invoice').style.display = 'inline-block';
  document.getElementById('placeholderText').style.display = 'none';

  //This code displays an animated car (vars initalized at the top of the program)
   x = 0;
   var canvas = document.getElementById('parkingLot');
   canvas.style.display = "block";
   context = canvas.getContext('2d');
   context.clearRect(0, 0, canvas.width, canvas.height);
   imageObj = new Image();
   imageObj.src = "car.png";
   imageObj.onload = function() {
     context.drawImage(imageObj, 0, 0, 200, 200);
   }
}

//This function is used to animate the car across the top of the screen
function animateCar(){
  //this function animates the car 600 pixels; it does it 2.5 pixels at a time every 25 milliseconds 
  if(x<600){
    context.clearRect(0,0,800,200);
    context.drawImage(imageObj, x, 0, 200, 200);
    x += 2.5;
  }
  //Hides canvas 1 secound after the animation displays by using the setTimeout method
  if(x==600){
    setTimeout(() => {document.getElementById('parkingLot').style.display = 'none'; x=0; clearInterval(animation);}, 1000); 
  }
}

  
