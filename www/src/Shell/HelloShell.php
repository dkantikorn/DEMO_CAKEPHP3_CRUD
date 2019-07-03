<?php

namespace App\Shell;

use Cake\Console\Shell;

/**
 * Hello shell command.
 */
class HelloShell extends Shell {

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser() {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main() {
        //$this->out($this->OptionParser->help());
        $this->out('Hi, Sarawutt.b');
    }

    /**
     * Function call specific function and with parameter run => ./cake hello hey_there sarawutt.b
     * @author sarawutt.b
     * @param type $name
     */
    public function heyThere($name = 'Anonymous') {
        $this->out('Hey there ' . $name);

        $color = $this->in('What color do you like?');
        $this->out($color);

        // Get a choice from the user.
        $selection = $this->in('Red or Green?', ['R', 'G'], 'R');

// Create a file
        $stuff = "{name:'demo_cake_php',author:'sarawutt.b'}";
        $this->createFile('bower.json', $stuff);

// Write to stdout
        $this->out('Normal message');

// Write to stderr
        $this->err('Error message');

// Write to stderr and raise a stop exception
        $this->abort('Fatal error');

// Before CakePHP 3.2. Write to stderr and exit()
        $this->error('Fatal error');

        // Output 2 newlines
        $this->out($this->nl(2));

// Clear the user's screen
        $this->clear();

// Draw a horizontal line
        $this->hr();
    }

}
