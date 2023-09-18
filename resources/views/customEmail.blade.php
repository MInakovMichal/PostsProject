<table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation"
       style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:100%">

    <tbody>
    <tr>
        <td style="box-sizing:border-box;padding:35px;text-align:center">
            <h1 style="box-sizing:border-box;color:#3d4852;font-size:19px;font-weight:bold;margin-top:0;text-align:center">
                {{ __('notification.greeting', [], strtolower(App::getLocale())) }}<br>
            </h1>
            @if(array_key_exists('value', $data))
                <div class="post-content" style="box-sizing:border-box;color:#3d4852;font-size:16px;line-height:1.5em;margin-top:0;text-align:center">
                    {!! $data['value'] !!}
                    <br>
                </div>
            @endif
            @if(array_key_exists('image', $data))
                    <img src="{{ asset('storage/' . $data['image']) }}" alt="Post Image">
                <br>
            @endif
            <p style="box-sizing:border-box;color:#3d4852;font-size:16px;line-height:1.5em;margin-top:0;text-align:center">
                {{ __('notification.regards', [], strtolower(App::getLocale())) }}
            </p>
        </td>
    </tr>
    </tbody>
</table>
