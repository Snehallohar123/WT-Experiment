function validateForm()
{
    const name=document.getElementById('name').value.trim();
    const dob=document.getElementById('dob').value;
    const adhar=document.getElementById('adhar').value.trim();
    const email=document.getElementById('email').value.trim();
    const address=document.getElementById('address').value.trim();
    const errormsg=document.getElementById('errorMsg');
    const result=document.getElementById('result');

    errormsg.innerHTML="";
    result.innerHTML="";

      if(! /^[a-zA-Z ]+$/.test(name))
      {
          errormsg.innerHTML="Name must contain only letters and spaces."
          return false;
      }
      if (!/^\d{12}$/.test(adhar)) {
          errormsg.innerHTML = "Aadhaar Number must be a 12-digit number.";
        return false;
      }

      if (!/^\S+@\S+\.\S+$/.test(email)) {
        errormsg.innerHTML = "Invalid Email format.";
        return false;
      }

      if (address.length < 10) {
        errormsg.innerHTML = "Address must be at least 10 characters long.";
        return false;
      }

      let birthDate=new Date(dob);
      let today=new Date();
      let age= today.getFullYear() - birthDate.getFullYear();
      let month=today.getMonth() - birthDate.getMonth();
      if(month<0 || (month ===0 && (today.getDate()< birthDate.getDate())))
      {
        age--;
      }
      if(age<18)
      {
        errormsg.innerHTML="You must be at least 18 years old";
        return false;
      }

      result.innerHTML = `
        <h3>Registration Successful!</h3>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>DOB:</strong> ${dob}</p>
        <p><strong>Aadhaar:</strong> ${adhar}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Address:</strong> ${address}</p>
      `;

    return false;
}