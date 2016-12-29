<?php
namespace Interop\Session\Writer\Utils\Segment\Writer;
use Interop\Session\Writer\SessionWriterInterface;
use Interop\Session\Manager\SessionManagerInterface;

class Writer implements SessionWriterInterface {

  protected $sessionManager = null;
  protected $prefix = "";

  public function __construct(SessionManagerInterface $sessionManager) {
    $this->sessionManager = $sessionManager;
  }

  public function save(iterable $session): void {
    if (!$_SESSION) {
      throw new \Exception("No session detected");
    }
    $this->sessionManager->ensureSessionHasStart();
    foreach ($session as $k => $v) {
      $_SESSION[$k] = $v;
    }
    $this->sessionManager->ensureCommit();
  }

}
