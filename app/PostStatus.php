<?php

namespace App;

enum PostStatus: string
{
    case draft = 'draft';
    case submitted = 'submitted';
    case accepted = 'accepted';
    case rejected = 'rejected';
}