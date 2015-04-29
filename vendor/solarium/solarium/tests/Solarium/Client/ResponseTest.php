<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 */

class Solarium_Client_ResponseTest extends PHPUnit_Framework_TestCase
{

    protected $_headers, $_data;

    /**
     * @var Solarium_Client_Response
     */
    protected $_response;

    public function setUp()
    {
        $this->_headers = array('HTTP/1.0 304 Not Modified');
        $this->_data = '{"responseHeader":{"status":0,"QTime":1,"params":{"wt":"json","q":"mdsfgdsfgdf"}},"response":{"numFound":0,"start":0,"docs":[]}}';
        $this->_response = new Solarium_Client_Response($this->_data, $this->_headers);
    }

    public function testGetStatusCode()
    {
        $this->assertEquals(304, $this->_response->getStatusCode());
    }

    public function testGetStatusMessage()
    {
        $this->assertEquals('Not Modified', $this->_response->getStatusMessage());
    }

    public function testGetHeaders()
    {
        $this->assertEquals($this->_headers, $this->_response->getHeaders());
    }

    public function testGetBody()
    {
        $this->assertEquals($this->_data, $this->_response->getBody());
    }

    public function testMissingHeader()
    {
        $headers = array();

        $this->setExpectedException('Solarium_Exception');
        new Solarium_Client_Response($this->_data, $headers);
    }

}