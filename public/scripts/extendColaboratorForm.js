document.addEventListener('DOMContentLoaded', () => 
{
    const ckMemberCheckbox = document.querySelector('input[name="ckMember"]');
    const dvExtraFields = document.getElementById('dvExtraFields');

    const tbEmail = document.querySelector('input[name="tbEmail"]');
    const tbPassword = document.querySelector('input[name="tbPassword"]');
    const tbPasswordConfirm = document.querySelector('input[name="tbPasswordConfirm"]');
    const tbCity = document.querySelector('input[name="tbCity"]');
    const tbStreet = document.querySelector('input[name="tbStreet"]');
    const tbMunicipality = document.querySelector('select[aria-label="Default select example"]');
    const tbReference = document.querySelector('input[name="tbReference"]');


    const toggleRequiredAttributes = (isRequired) => 
    {
        if (tbEmail) tbEmail.required = isRequired;
        if (tbPassword) tbPassword.required = isRequired;
        if (tbPasswordConfirm) tbPasswordConfirm.required = isRequired;
        if (tbCity) tbCity.required = isRequired;
        if (tbStreet) tbStreet.required = isRequired;
        if (tbMunicipality) tbMunicipality.required = isRequired;
    };

    ckMemberCheckbox.addEventListener('change', () => 
    {
        if (ckMemberCheckbox.checked) 
        {
            dvExtraFields.style.display = 'block';
            toggleRequiredAttributes(true);
        } 
        else 
        {
            dvExtraFields.style.display = 'none';
            toggleRequiredAttributes(false);
            if (tbEmail) tbEmail.value = '';
            if (tbPassword) tbPassword.value = '';
            if (tbPasswordConfirm) tbPasswordConfirm.value = '';
            if (tbCity) tbCity.value = '';
            if (tbStreet) tbStreet.value = '';
            if (tbMunicipality) tbMunicipality.value = '';
            if (tbReference) tbReference.value = '';
        }
    });

    if (ckMemberCheckbox.checked) 
    {
        dvExtraFields.style.display = 'block';
        toggleRequiredAttributes(true);
    }
});
