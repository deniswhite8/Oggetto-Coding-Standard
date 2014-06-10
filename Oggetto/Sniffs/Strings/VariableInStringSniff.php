<?php
class Oggetto_Sniffs_Strings_VariableInStringSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_DOUBLE_QUOTED_STRING);
    }


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $content = $tokens[$stackPtr]["content"];

        if (preg_match('/\${\w+}/', $content)) {
            $message = '${name} is prohibited, use $name or {$name}';
            $phpcsFile->addError($message, $stackPtr, 'Found');
        }
    }
}
