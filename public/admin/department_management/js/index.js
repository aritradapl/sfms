document.addEventListener('DOMContentLoaded', () => 
{
    const form=document.getElementById('form');
    var deptName=document.getElementById('dept');

    form.addEventListener('submit', e => 
    {
        //alert('hii');
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
        var deptNameValue=deptName.value.trim();

        if(deptNameValue === '') 
        {
            is_valid = true;
            setError(deptName,'Department Name is required');
        } 
        else if(!isNaN(deptNameValue))
        {
            is_valid = true;
            setError(deptName,'Please Enter Valid Department Name');
        }
        else 
        {
            setSuccess(deptName);
        }
        return is_valid;
    }
});