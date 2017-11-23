#!/usr/bin/php
<?php

/**
 * The application that handles all calls
 */
class MyApp {
    /**
     * Actions class instance
     * @var Actions
     */
    private $actions;
    /**
     * When to clean up and exit
     * @var bool
     */
    public static $exitProgram = false;

    /**
     * Start program execution
     */
    public function __construct() {
        $this->setup();
        $this->dispatcher();
    }

    /**
     * Setup dispatcher before anything else can run
     */
    private function setup() {
        $this->setupIncludes();
        $this->actions = new Actions();
        $this->actions->registerActions();
    }

    /**
     * Include necessary files
     */
    private function setupIncludes() {
        require 'db.php';
        require 'actions.php';
    }

    /**
     * Dispatch after program is setup
     */
    public function dispatcher() {
        do {
            $this->printDisplay();
            $this->getAction();
            if( $this->action !== false ){
                $this->actions->performAction($this->action);
            }
        } while( ! self::$exitProgram );
    }

    /**
     * Display user options
     */
    private function printDisplay() {
        printf("\nPossible actions:\n");
        $count = 0;
        foreach($this->actions->getTexts() as $text) {
            $count++;
            printf("\t%d) %s\n", $count, $text);
        }
        printf("Select an option 1-$count to complete:");
    }

    /**
     * Get user action and validate
     */
    private function getAction() {
        $this->action = false;
        $action = readline();
        if( is_numeric($action) && intval($action) == $action) {
            $this->action = intval($action) - 1;
        } else {
            printf("\n\tInvalid Action\n");
        }
    }

    /** 
     * End the program
     */
    public static function end() {
        self::$exitProgram = true;
    }

    /**
     * Debugging method to trace errors
     * @param string $msg
     */
    public static function error(string $msg) {
        printf("\n%s\n", $msg);
        var_dump(debug_backtrace());
        exit();
    }
}

new MyApp();
