<?php

namespace App\Enum;

enum StateEnum: string
{
    case AC = "AC";
    case AL = "AL";
    case AP = "AP";
    case AM = "AM";
    case BA = "BA";
    case CE = "CE";
    case DF = "DF";
    case ES = "ES";
    case GO = "GO";
    case MA = "MA";
    case MT = "MT";
    case MS = "MS";
    case MG = "MG";
    case PA = "PA";
    case PB = "PB";
    case PR = "PR";
    case PE = "PE";
    case PI = "PI";
    case RJ = "RJ";
    case RN = "RN";
    case RS = "RS";
    case RO = "RO";
    case RR = "RR";
    case SC = "SC";
    case SP = "SP";
    case SE = "SE";
    case TO = "TO";

    public function label(): string
    {
        return match($this) {
            static::AC => 'Acre',
            static::AL => 'Alagoas',
            static::AP => 'Amapá',
            static::AM => 'Amazonas',
            static::BA => 'Bahia',
            static::CE => 'Ceará',
            static::DF => 'Distrito Federal',
            static::ES => 'Espírito Santo',
            static::GO => 'Goiás',
            static::MA => 'Maranhão',
            static::MT => 'Mato Grosso',
            static::MS => 'Mato Grosso do Sul',
            static::MG => 'Minas Gerais',
            static::PA => 'Pará',
            static::PB => 'Paraíba',
            static::PR => 'Paraná',
            static::PE => 'Pernambuco',
            static::PI => 'Piauí',
            static::RJ => 'Rio de Janeiro',
            static::RN => 'Rio Grande do Norte',
            static::RS => 'Rio Grande do Sul',
            static::RO => 'Rondônia',
            static::RR => 'Roraima',
            static::SC => 'Santa Catarina',
            static::SP => 'São Paulo',
            static::SE => 'Sergipe',
            static::TO => 'Tocantins',
        };
    }
}
