<?php
class Oggetto_Sniffs_Class_PublicFieldsSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_PUBLIC);
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
        $type = $tokens[$stackPtr + 2]['type'];

        if ($type == 'T_VARIABLE') {
            $message = 'Public variables is prohibited, use set and/or get methods';
            $phpcsFile->addError($message, $stackPtr, 'Found');
        }
    }
}
