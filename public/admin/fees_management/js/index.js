$("#amount").keyup(function()
{
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
document.addEventListener('DOMContentLoaded', () =>
{
    const form=document.getElementById('form');
    var stuId=document.getElementById('student_id');
    var yearId=document.getElementById('year_id');
    var monthId=document.getElementById('month_id');
    var amount=document.getElementById('amount');

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
        var stuIdValue=stuId.value.trim();
        var yearIdValue=yearId.value.trim();
        var monthIdValue=monthId.value.trim();
        var amountValue=amount.value.trim();

        if(stuIdValue === '')
        {
            is_valid = true;
            setError(stuId,'*Student Name is required');
        }
        else
        {
            setSuccess(stuId);
        }
        if(yearIdValue ==='')
        {
            is_valid = true;
            setError(yearId, '*Year is required');
        }
        else
        {
            setSuccess(yearId);
        }
        if(monthIdValue ==='')
        {
            is_valid = true;
            setError(monthId, '*Month is required');
        }
        else
        {
            setSuccess(monthId);
        }
        if(amountValue ==='')
        {
            is_valid = true;
            setError(amount, '*Amount is required');
        }
        else
        {
            setSuccess(amount);
        }
        return is_valid;
    }
});
document.getElementById('student_id').addEventListener('change', function () {
    document.getElementById("year-div").classList.remove("d-none");
});
document.getElementById('year_id').addEventListener('change', function () {
    document.getElementById("month-div").classList.remove("d-none");
});
document.getElementById('month_id').addEventListener('change', function () {
    document.getElementById("amount-div").classList.remove("d-none");
});
document.getElementById('amount').addEventListener("input", function() {
    if (document.getElementById('amount').value.trim() !== "") {
        document.getElementById('submit').disabled = false;
    } else {
        // If the value is empty, disable the button
        document.getElementById('submit').disabled = true;
    }
});
