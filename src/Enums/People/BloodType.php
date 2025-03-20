<?php

namespace Zahzah\ModulePeople\Enums\People;

enum BloodType: string{
    case A           = 'A'; 
    case B           = 'B'; 
    case O           = 'O'; 
    case AB          = 'AB'; 
    case A_NEGATIVE  = 'A-'; 
    case B_NEGATIVE  = 'B-'; 
    case O_NEGATIVE  = 'O-'; 
    case AB_NEGATIVE = 'AB-'; 
    case A_POSITIVE  = 'A+'; 
    case B_POSITIVE  = 'B+'; 
    case O_POSITIVE  = 'O+'; 
    case AB_POSITIVE = 'AB+';
}