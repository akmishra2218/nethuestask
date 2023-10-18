<form method="post" action="/save-lists" id="companylist">
    @csrf
    <div>
        <select name="company_symbol">
            @foreach ($symbols as $symbol)
                <option value="{{ $symbol }}">{{ $symbol }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="startdate">Start date:</label>
        <input type="date" name="start_date">
    </div>

    <div>
        <label for="enddate">End date:</label>
        <input type="date" name="end_date">
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="text" name="email">
    </div>

    <div>
        <button type="submit">Submit</button>
    </div>

</form>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
    integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("Form#companylist").validate({
            rules: {
                company_symbol: {
                    required: true,
                    maxlength: 255,
                },
                start_date: {
                    required: true,
                    date: true,
                    maxDate: true
                },
                end_date: {
                    required: true,
                    date: true,
                    maxDate: true
                },
                email: {
                    required: true,
                    customEmailValidation: true
                },
            },
            messages: {
                'company_symbol': {
                    required: 'Please provide company symbol.'
                },
                'start_date': {
                    required: 'Please provide date of birth option.',
                    date: 'Please enter a valid date.',
                    maxDate: 'Date of birth cannot be in the future.'
                },
                'end_date': {
                    required: 'Please provide date of birth option.',
                    date: 'Please enter a valid date.',
                    maxDate: 'Date of birth cannot be in the future.'
                },
                'email': {
                    required: 'Please provide email option.',
                    customEmailValidation: "Please provide a valid email address."
                },
            }
        });
        $.validator.addMethod('maxDate', function(value, element) {
            var inputDate = new Date(value);
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0); 

            return inputDate <= currentDate;
        }, '');

        $.validator.addMethod("customEmailValidation", function(value, element) {
                const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
                return this.optional(element) || emailRegex.test(value);
            }, "Please provide a valid email address.");
    });
</script>
