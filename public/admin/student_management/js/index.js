document.addEventListener('DOMContentLoaded', () => 
{
    const form=document.getElementById('form');
    var stuName=document.getElementById('student_name');
    var male=document.getElementById('male');
    var female=document.getElementById('female');
    var phone=document.getElementById('phone');
    var address=document.getElementById('address');
    var deptName=document.getElementById('dept_id');
    var session=document.getElementById('year');

    form.addEventListener('submit', e => 
    {
        //e.preventDefault();
        if(validateInputs()) 
        {
            e.preventDefault();
        }
    });
    const setError = (element, message) => 
    {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.text-danger');
  
        errorDisplay.innerText = message;
        element.classList.add('is-invalid');
        element.classList.remove('is-valid');
    }
    const setSuccess = element => 
    {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.text-danger');

        errorDisplay.innerText = '';
        element.classList.add('is-valid');
        element.classList.remove('is-invalid');
    }
    const validateInputs = () => 
    {
        let is_valid = false;
        var stuNameValue=stuName.value.trim();
        var phoneValue=phone.value.trim();
        var addressValue=address.value.trim();
        var deptNameValue=deptName.value.trim();
        var sessionValue=session.value.trim();

        if(stuNameValue === '') 
        {
            is_valid = true;
            setError(stuName,'Name is required');
        } 
        else if(!isNaN(stuNameValue))
        {
            is_valid = true;
            setError(stuName,'Please Enter Valid Name');
        }
        else 
        {
            setSuccess(stuName);
        }
        if((!male.checked)&&(!female.checked))
        {
            is_valid = true;
            setError(gender_error,'Gender is required');
        }
        else
        {
            setSuccess(gender_error);
        }
        if(phoneValue ==='') 
        {
            is_valid = true;
            setError(phone, 'Mobile Number is required');
        } 
        else if(isNaN(phoneValue))
        {
            is_valid = true;
            setError(phone,'Please Enter Numeric Value');
        }
        else if((phoneValue.length<10)||(phoneValue.length>12))
        {
            is_valid = true;
            setError(phone, 'Mobile Number must be at least 10 Digit and must not be greater than 12.');
        }
        else 
        {
            setSuccess(phone);
        }
        if(addressValue ==='') 
        {
            is_valid = true;
            setError(address, 'Address is required');
        } 
        else 
        {
            setSuccess(address);
        }
        if(deptNameValue === '') 
        {
            is_valid = true;
            setError(deptName,'Department is required');
        } 
        else 
        {
            setSuccess(deptName);
        }
        if(sessionValue ==='') 
        {
            is_valid = true;
            setError(session, 'Session is required');
        } 
        else 
        {
            setSuccess(session);
        }
        return is_valid;
    }
});