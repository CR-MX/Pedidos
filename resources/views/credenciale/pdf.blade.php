<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: 243pt 153pt;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 7pt;
            color: #000;
        }

        .sm-tlt {
            font-size: 6px;
        }

        .sm-info {
            font-size: 9px;
        }

        .sms-info {
            font-size: 7px;

        }
    </style>
</head>

<body>
    <span style="width:241pt; height:151pt; padding:1pt;">
        <br>
        <br>
        <br>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    <table>
                        <tr>
                            <td>
                                @if ($credenciale->foto)
                                    <img src="{{ $credenciale->foto }}" style="width:55pt; height:70pt;">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>

                                @if ($credenciale->firma)
                                    <img src="{{ $credenciale->firma }}" style="height:20pt;">
                                @endif
                            </td>
                        </tr>
                    </table>

                </td>
                <td valign="top">
                    <table>
                        <tr>
                            <td class="sm-tlt">
                                CURP / POPULATION ID
                            </td>
                        </tr>
                        <tr>
                            <td class="sms-info">
                                {{ $credenciale->curp ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                APELLIDO PATERNO / PATERNAL SURNAME
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-info">
                                {{ $credenciale->apellido_paterno ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                APELLIDO MATERNO / MATERNAL SURNAME
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-info">
                                {{ $credenciale->apellido_materno ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                NOMBRES(S) / NAME
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-info">
                                {{ $credenciale->nombres ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                FECHA DE NACIMIENTO
                            </td>
                        </tr>
                        <tr>
                            <td class="sms-info">
                                {{ $credenciale->fecha_nacimiento ? \Carbon\Carbon::parse($credenciale->fecha_nacimiento)->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                FECHA DE EXPEDICIÓN / ISSUE
                            </td>
                        </tr>
                        <tr>
                            <td class="sms-info">
                                {{ $credenciale->fecha_expedicion ? \Carbon\Carbon::parse($credenciale->fecha_expedicion)->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                FECHA DE VENCIMIENTO / EXPIRES ON
                            </td>
                        </tr>
                        <tr>
                            <td class="sms-info">
                                {{ $credenciale->fecha_vencimiento ? \Carbon\Carbon::parse($credenciale->fecha_vencimiento)->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top">
                    <table>
                        <tr>
                            <td class="sm-tlt">TIPO DE LICENCIA / CLASS</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt"> {{ $credenciale->tipo_licencia ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">NÚMERO DE LICENCIA / LICENSE NUMBER</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">
                                {{ str_pad($credenciale->numero_licencia, 9, '0', STR_PAD_LEFT) ?? '' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </span>

    <span style="width:241pt; height:151pt; padding:1pt;">
        <br>
        <br>
        <br>
        <table  style="width:243pt;" cellpadding="0" cellspacing="0">

            <tr>
                <td valign="top" style="width:50%;" >
                    <table>
                        <tr>
                            <td class="sm-tlt"> OFICINA EMISORA / OFFICE</td>
                        </tr>
                        <tr>
                            <td class="sm-info"> {{ $credenciale->oficinaEmisora->nombre ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt"> FECHA DE ANTIGÜEDAD / DRIVER SINCE</td>
                        </tr>
                        <tr>
                            <td class="sm-info"> {{ $credenciale->fecha_antiguedad ? \Carbon\Carbon::parse($credenciale->fecha_antiguedad)->format('d/m/Y') : ($credenciale->fecha_expedicion ? \Carbon\Carbon::parse($credenciale->fecha_expedicion)->format('d/m/Y') : '') }}</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt"> DONADOR DE ÓRGANOS / DONOR</td>
                        </tr>
                        <tr>
                            <td class="sm-info"> {{ $credenciale->donador_organos === 1 ? 'Sí' : ($credenciale->donador_organos === 0 ? 'No' : '') }}</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">  RESTRICCIONES / RESTRICTIONS</td>
                        </tr>
                        <tr>
                            <td class="sm-info"> {{ $credenciale->restricciones ?? '' }}</td>
                        </tr>

                    </table>
                </td>
                <td valign="top"  style="width:50%;">
                    <table>

                        <tr>
                            <td class="sm-tlt"> SEXO / SEX</td>
                        </tr>
                        <tr>
                            <td class="sm-info"> {{ $credenciale->sexo ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt"> TIPO DE SANGRE</td>
                        </tr>
                        <tr>
                            <td class="sm-info"> {{ $credenciale->tipo_sangre ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="sm-tlt">EN CASO DE ACCIDENTE LLAMAR A / <br> IN CASE OF ACCIDENT CALL TO</td>
                        </tr>
                        <tr>
                            <td class="sms-info"> {{ trim(($credenciale->en_caso_accidente_nombre ?? '').' '.($credenciale->en_caso_accidente_numero ?? '')) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </span>
</body>

</html>
