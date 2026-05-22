<?php

namespace App;

enum PermissionType: string
{
    case include = "include";
    case exclude = "exclude";
}
