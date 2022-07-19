/*Siddharth Tiwari, 11/23/30, JS File

  key features:
    contains functions to show and close modal boxes
            
*/

//Displays model box
function showModal(modal){
    document.getElementById(modal).style.display = "block";
}
  
  //This hides the modal if the user clicks on the grey 'x's at the top right of each modal
function closeModal(modal) {
    document.getElementById(modal).style.display = "none";
}
  