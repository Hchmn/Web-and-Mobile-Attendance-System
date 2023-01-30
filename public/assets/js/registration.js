// function updateOption() {
  

//   year_and_sections = {
//     "1": ["Mercury", "Venus", "Earth", "Mars", "Saturn"],
//     "2": ["Molave", "Ilang-Ilang", "Narra", "Dapdap"],
//     "3": ["Diamond", "Garnet", "Emerald", "Jade"],
//     "4": ["Taal", "Mayon", "Pinatubo", "Banahaw"],
//   };

//   var year = document.getElementById("year").value;

//   console.log("YEAR : " + year);
//   var sectionNodeList = document.getElementsByClassName("section");

//   // clear select options
//   for (var i = 0; i < sectionNodeList.length; i++) {
//     while (sectionNodeList[i].options.length) {
//       sectionNodeList[i].remove(0);
//     }
//   }

//   var sections = year_and_sections[year];

//   if (sections) {
//     for (var j = 0; j < sectionNodeList.length; j++) {
//       for (var i = 0; i < sections.length; i++) {
//         var section = new Option(sections[i]);
//         sectionNodeList[j].options.add(section);
//       }
//     }
//   }
// }

// function generateQRCode() {
//   let username = document.getElementById("firstname").value;
//   let password = document.getElementById("lastname").value;

//   let qrcode = username + password;

//   if (username && password) {
//     let qrcodeContainer = document.getElementById("qrcode");
//     qrcodeContainer.innerHTML = "";
//     new QRCode(qrcodeContainer, qrcode);
//     document.getElementById("qrcode-container").style.display = "block";
//     document.getElementById("qrcode-container").style.marginBottom = "40px";
//   } else {
//     alert("YOU MUST FILL ALL THE REQUIREMENTS BEFORE GENERATING THE QRCODE");
//   }
// }
