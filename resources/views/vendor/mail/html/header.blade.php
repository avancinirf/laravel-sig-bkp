<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Consigsa')
<img src="http://consigsa.test/img/marca_horizontal_grande.png" class="logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
