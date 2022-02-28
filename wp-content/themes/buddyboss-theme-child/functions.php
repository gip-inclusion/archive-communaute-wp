<?php

foreach ( glob(__DIR__ . '/includes/*.php' ) as $file ) {
  include_once $file;
}
