<?php
class Oggetto_Sniffs_Functions_FunctionArgumentsWhiteSpaceSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_STRING);
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

        if ($tokens[$stackPtr - 2]['type'] == 'T_FUNCTION' &&
                ($tokens[$stackPtr + 1]['type'] == 'T_OPEN_PARENTHESIS' ||
                $tokens[$stackPtr + 2]['type'] == 'T_OPEN_PARENTHESIS')) {
            while($tokens[++$stackPtr]['type'] != 'T_CLOSE_PARENTHESIS') {
                if($tokens[$stackPtr]['type'] == 'T_COMMA' && $tokens[$stackPtr + 1]['content'] != ' ') {
                    $message = 'Expected one whitespace after comma';
                    $phpcsFile->addError($message, $stackPtr, 'Expected');
                }
            }
        }
    }
}
