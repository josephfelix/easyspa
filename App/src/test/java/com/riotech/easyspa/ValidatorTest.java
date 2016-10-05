/**
 * Version information
 *
 * @package com.riotech.easyspa
 * @copyright 2016 Rio Tech
 * @author Joseph F.
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
package com.riotech.easyspa;

import org.junit.Test;
import com.riotech.easyspa.model.User;
import static org.junit.Assert.*;

/**
 * Classe usada para os testes de validação
 */
public class ValidatorTest {
    @Test
    public void email_isValid() throws Exception {
        User usr = new User();
        usr.setEmail("example@test.com");
        assertTrue(usr.isValidEmail());

        usr.setEmail("test.com");
        assertFalse(usr.isValidEmail());
    }

    @Test
    public void password_isValid() throws Exception {
        User usr = new User();
        usr.setPassword("abcd123");
        assertTrue(usr.isValidPassword());

        usr.setPassword("abc");
        assertFalse(usr.isValidPassword());
    }
}